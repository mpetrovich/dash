
DOCKER_IMAGE ?= dash
PHP_VERSION ?= 7.4
DOCKER_TAG := $(DOCKER_IMAGE):php$(PHP_VERSION)
DOCKER_RUN := docker run --rm -v "$(CURDIR)":/usr/src/dash -w /usr/src/dash $(DOCKER_TAG)


# Installs all dependencies
default:
	@composer install


# Runs unit tests
#
# To run tests for a single operation, add `op=<operation>`.
#
# Example:
#   make test op=map
#
test:
ifdef op
	@vendor/bin/phpunit tests/$(op)Test.php --no-coverage
else
	@vendor/bin/phpunit tests/ --no-coverage
endif


# Runs all unit tests with code coverage analysis
#
# To generate code coverage for a single operation, add `op=<operation>`.
#
# Example:
#   make test-coverage op=map
#
test-coverage:
ifdef op
	@vendor/bin/phpunit tests/$(op)Test.php --coverage-text
else
	@vendor/bin/phpunit tests/ --coverage-text
endif
# @echo "Test coverage visible at:" $(shell pwd)/test-coverage/index.html


# Checks code against style rules
#
# To check a single operation, add `op=<operation>`
#
# Example:
#   make check-style op=map
#
check-style:
ifdef op
	@vendor/bin/phpcs --standard=phpcs.xml -s src/$(op).php
else
	@vendor/bin/phpcs --standard=phpcs.xml -s src/
endif


# Fixes code to match style rules
#
# To fix a single operation, add `op=<operation>`
#
# Example:
#   make fix-style op=map
#
fix-style:
ifdef op
	@vendor/bin/phpcbf --standard=phpcs.xml -s src/$(op).php
else
	@vendor/bin/phpcbf --standard=phpcs.xml -s src/
endif


# Builds documentation for all operations
docs:
	@php bin/docs.php src docs/Operations.md


# Removes all generated files
clean:
	@rm -rf test-coverage/ vendor/


# Runs release preflight checks in local environment
release-check:
	make test
	make check-style
	make docs


# Creates, tags, and pushes a new release
#
# Example:
# 	make release v=1.2.3
#
release:
	git add docs/Operations.md
	git commit -m "Release v$v" --allow-empty
	git tag -a v$(v) -m v$(v)
	git push
	git push --tags


# Docker helpers
#
# Examples:
#   make docker-build PHP_VERSION=8.2
#   make docker-make-test PHP_VERSION=8.0 op=map
#
docker-build:
	docker build --build-arg PHP_VERSION=$(PHP_VERSION) -t $(DOCKER_TAG) .

docker-shell: docker-build
	docker run --rm -it -v "$(CURDIR)":/usr/src/dash -w /usr/src/dash $(DOCKER_TAG) /bin/bash

docker-make-install: docker-build
	$(DOCKER_RUN) make

docker-make-test: docker-build
	$(DOCKER_RUN) make test op=$(op)

docker-make-test-coverage: docker-build
	$(DOCKER_RUN) make test-coverage op=$(op)

docker-make-check-style: docker-build
	$(DOCKER_RUN) make check-style op=$(op)

docker-make-fix-style: docker-build
	$(DOCKER_RUN) make fix-style op=$(op)

docker-make-docs: docker-build
	$(DOCKER_RUN) make docs

docker-make-clean: docker-build
	$(DOCKER_RUN) make clean

docker-release-check: docker-build
	$(DOCKER_RUN) make test
	$(DOCKER_RUN) make check-style
	$(DOCKER_RUN) make docs


# Forces these commands to always run
.PHONY: test test-coverage docs release-check docker-build docker-shell docker-make-install docker-make-test docker-make-test-coverage docker-make-check-style docker-make-fix-style docker-make-docs docker-make-clean docker-release-check

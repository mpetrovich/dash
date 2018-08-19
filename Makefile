
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
	@vendor/bin/phpunit tests/$(op)Test --no-coverage
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
	@vendor/bin/phpunit tests/$(op)Test
else
	@vendor/bin/phpunit tests/
endif
@echo "Test coverage visible at:" $(shell pwd)/test-coverage/index.html


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
	@bin/docs.php src docs/Operations.md


# Removes all generated files
clean:
	@rm -rf test-coverage/ vendor/


# Creates, tags, and pushes a new release
#
# Example:
# 	make release v=1.2.3
#
release:
	make test
	make docs
	git add docs/Operations.md
	git commit -m "Release v$v" --allow-empty
	git tag -a v$(v) -m v$(v)
	git push
	git push --tags


# Forces these commands to always run
.PHONY: test test-coverage docs


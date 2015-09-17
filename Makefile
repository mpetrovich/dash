# -----------------------------------------------------------------------------
# Tests
# -----------------------------------------------------------------------------

test:
	@vendor/bin/phpunit --color tests/

test-coverage:
	@vendor/bin/phpunit --color --coverage-html=test-coverage --strict-coverage tests/
	@echo "Test coverage visible at:" $(shell pwd)/test-coverage/index.html

test-clean:
	@rm -rf test-coverage/

# -----------------------------------------------------------------------------
# Documentation
# -----------------------------------------------------------------------------

docs:
	@vendor/bin/phpdoc -d src/ -t docs/
	@echo "Docs visible at:" $(shell pwd)/docs/index.html

docs-clean:
	@rm -rf docs/

# -----------------------------------------------------------------------------
# Release
# -----------------------------------------------------------------------------

clean:
	make test-clean
	make docs-clean

release:
	make clean
	make test
	make docs
	git commit -am "Release "$1
	git tag -a v$1 -m v$1


# Forces these commands to always run
.PHONY: test-coverage docs

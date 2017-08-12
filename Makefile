# -----------------------------------------------------------------------------
# Tests
# -----------------------------------------------------------------------------

test:
	@vendor/bin/phpunit

test-unit:
	@vendor/bin/phpunit --no-coverage --testsuite unit

test-perf:
	@vendor/bin/phpunit --no-coverage --testsuite perf

test-coverage:
	@vendor/bin/phpunit --testsuite unit
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
	git commit -am "Release "$(version)
	git tag -a v$(version) -m v$(version)


# Forces these commands to always run
.PHONY: test test-coverage docs

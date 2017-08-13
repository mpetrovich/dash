# -----------------------------------------------------------------------------
# Tests
# -----------------------------------------------------------------------------

test:
	make test-coverage
	make test-perf

test-unit:
	@vendor/bin/phpunit --no-coverage --testsuite unit

test-one:
	@vendor/bin/phpunit test/unit/$(test)Test --no-coverage --testsuite unit

test-perf:
	@vendor/bin/phpunit --no-coverage --testsuite perf

test-coverage:
	@vendor/bin/phpunit --testsuite unit
	@echo "Test coverage visible at:" $(shell pwd)/test-coverage/index.html

test-clean:
	@rm -rf test-coverage/

# -----------------------------------------------------------------------------
# Release
# -----------------------------------------------------------------------------

clean:
	make test-clean

# Tags a new release.
#
# Example:
# 	make release version=1.2.3
#
release:
	make clean
	make test
	git tag -a v$(version) -m v$(version)


# Forces these commands to always run
.PHONY: test test-coverage docs

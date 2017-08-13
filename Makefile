
# Runs all unit tests
test:
	@vendor/bin/phpunit --no-coverage


# Runs a single test file
#
# Example:
#   make test-one test=map
#
test-one:
	@vendor/bin/phpunit test/$(test)Test --no-coverage


# Runs all tests with code coverage analysis
test-coverage:
	@vendor/bin/phpunit
	@echo "Test coverage visible at:" $(shell pwd)/test-coverage/index.html


# Removes all generated files
clean:
	@rm -rf test-coverage/


# Tags a new release
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

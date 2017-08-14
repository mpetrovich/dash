
# Runs unit tests
#
# To run tests for a single operation, add `op=<operation>`.
# If omitted, all tests will be run.
#
# Example:
#   make test-one op=map
#
test:
ifdef op
	@vendor/bin/phpunit test/$(op)Test --no-coverage
else
	@vendor/bin/phpunit --no-coverage
endif


test-one:
	@vendor/bin/phpunit test/$(test)Test --no-coverage


# Runs all tests with code coverage analysis
test-coverage:
	@vendor/bin/phpunit
	@echo "Test coverage visible at:" $(shell pwd)/test-coverage/index.html


# Builds documentation for all operations
docs:
	@bin/docs src Operations.md


# Removes all generated files
clean:
	@rm -rf test-coverage/


# Tags a new release
#
# Example:
# 	make release v=1.2.3
#
release:
	make clean
	make test
	make docs
	git add Operations.md
	git commit -m "Auto-update docs"
	git tag -a v$(v) -m v$(v)
	git push
	git push --tags


# Forces these commands to always run
.PHONY: test test-coverage docs


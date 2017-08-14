
# Runs unit tests
#
# To run tests for a single operation, add `op=<operation>`.
# If omitted, all tests will be run.
#
# Example:
#   make test op=map
#
test:
ifdef op
	@vendor/bin/phpunit src/$(op)/$(op)Test --no-coverage
else
	@vendor/bin/phpunit --no-coverage
endif


# Runs all unit tests with code coverage analysis
#
# To run tests with code coverage for a single operation, add `op=<operation>`.
# If omitted, all tests will be run.
#
# Example:
#   make test-coverage op=map
#
test-coverage:
ifdef op
	@vendor/bin/phpunit src/$(op)/$(op)Test
else
	@vendor/bin/phpunit
endif
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
	git commit -m "Auto-update docs" --allow-empty
	git tag -a v$(v) -m v$(v)
	git push
	git push --tags


# Forces these commands to always run
.PHONY: test test-coverage docs


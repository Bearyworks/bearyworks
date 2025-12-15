Feature: Hello World
    In order to verify the bundle works
    As a developer
    I need to be able to see a hello world message

    Scenario: Visiting the hello world page
        When I visit the hello world page
        Then I should see "Hello World"
        And the response status code should be 200

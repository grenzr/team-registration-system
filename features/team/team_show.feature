Feature: Team Show
  In order for me to review and manage a team I have created
  As a User, I can visit my Team's page when I login

  Background:
    Given that "the event" is an Event called "Upcoming Three Towers" taking place "+6 months" from now
    And that "the hike" is a Hike called "Scout Hike" for "the event"
    And that "the user" is a User with email "john@acme.co" and password "Password1!"

  Scenario: I can visit my Team's page
    Given that "the user's team" is a Team called "Alpha Team" for "the hike" registered by "the user"
    When I log in with email "john@acme.co" and password "Password1!"
    And I follow "Alpha Team"
    Then the response status code should be 200
    And the title should be "Alpha Team » Scout Hike » Upcoming Three Towers » Team Registration System"

  Scenario: I cannot visit a Team page for a Team I did not register
    Given that "the other user" is a User with email "jane@acme.co" and password "Password1!"
    And that "the other user's team" is a Team called "Alpha Team" for "the hike" registered by "the other user"
    When I log in with email "john@acme.co" and password "Password1!"
    And I go to the Team page for "the other user's team"
    Then the response status code should be 403
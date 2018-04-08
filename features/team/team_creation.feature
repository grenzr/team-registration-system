Feature:0

  In order for my team to be able to participate in an event
  I need to be able to register their details on the system

  Scenario: I can create a team
    Given that there is an Event called "Scout Hike 2019"
    And there is a User with email "john@acme.co" and password "Password1!"
    And that I have logged in with email "john@acme.co" and password "Password1!"
    And I follow "Add Team"
    When I fill in "Name" with "Alpha Team"
    And I select "Scout Hike 2019" from "Event"
    And I press "Save"
    Then the title should be "Alpha Team » Scout Hike 2019 » Team Registration System"
    And there is an alert with the message 'Team "Alpha Team" successfully created for "Scout Hike 2019"'

  Scenario: I cannot create a team if the team name is already in use
    Given that there is an Event called "Scout Hike 2019"
    And there is a User with email "john@acme.co" and password "Password1!"
    And that there is a Team called "Alpha Team" for the Event "Scout Hike 2019" registered by "john@acme.co"
    And that I have logged in with email "john@acme.co" and password "Password1!"
    And I follow "Add Team"
    When I fill in "Name" with "Alpha Team"
    And I select "Scout Hike 2019" from "Event"
    And I press "Save"
    Then the title should be "New Team » Team Registration System"
    And there is an alert with the message 'There were some problems with the information you provided'

  Scenario: I can create a team if the team name is already in use but on a separate event
    Given that there is an Event called "Scout Hike 2019"
    And that there is an Event called "Scout Hike 2018"
    And there is a User with email "john@acme.co" and password "Password1!"
    And that there is a Team called "Alpha Team" for the Event "Scout Hike 2018" registered by "john@acme.co"
    And that I have logged in with email "john@acme.co" and password "Password1!"
    And I follow "Add Team"
    When I fill in "Name" with "Alpha Team"
    And I select "Scout Hike 2019" from "Event"
    And I press "Save"
    Then the title should be "Alpha Team » Scout Hike 2019 » Team Registration System"
    And there is an alert with the message 'Team "Alpha Team" successfully created for "Scout Hike 2019"'


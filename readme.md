# Contest [![Build Status](https://travis-ci.org/giorgiosaud/wedcontest2018.svg?branch=master)](https://travis-ci.org/giorgiosaud/wedcontest2018) [![StyleCI](https://styleci.io/repos/123292448/shield?branch=master)](https://styleci.io/repos/123292448)
## Parts 

1. Contest is 
    1. id
    2. user_id
    3. topic
    4. year
2. Categories
    1. id
    2. contest_id
    3. name 
    4. max_age
3. Users (Representants by default,judges,administrators)
    1. id
    2. name
    3. last_name
    4. country
    5. phone
    6. referred
    7. language
    8. subscribed
    9. verified
    10. email
    11. password
    12. Remember Token
4. Contestants that belongs to a Representant must be subscribed to contest and belongs to a category

5. Artworks that belongs to contestants and contest and category

## Actual tests
### the test that passes are the ones with x in the box the other ones are wip

#### s\Feature\RegisterRepresentant
 [x] A guest can register as representant and appears as unconfirmed
 [x] User can fully confirm their email addresses
 [x] Confirming an invalid token
 [x] Name cannot exceed 255 chars
 [x] Email is required
 [x] Email is valid
 [x] Email cannot exceed 255 chars
 [x] Email is unique
 [x] Password is required
 [x] Password must be confirmed
 [x] Password must be 6 chars

#### s\Feature\RegisterRepresentantTranslation
 [x] A user see form in english if browser locale is set in english
 [x] A confirmation email is sent upon registration in spanish
 [x] A confirmation email is sent upon registration in english
 [x] A user see form in english if browser locale is set in spanish

#### s\Feature\CreateContest
 [ ] An administrator user can create new contest
 [x] Guest may not create a contest

#### s\Feature\ReadContest
 [x] A user can see all tests
 [x] A can see a single test
 [x] A user can request all categories for a given contest

#### s\Unit\Category
 [x] A category belongs to a contest

#### s\Unit\Contest
 [x] A contest have a path
 [x] A contest can be called by slug
 [x] A contest has a creator
 [x] A thread has categories
 [x] A contest have active prop
 [ ] A contest could have a intro image
 [ ] A default contest image can change

#### s\Unit\Contestant
 [x] A contestant must have a representant

#### s\Unit\User
 [x] A user may have contestants
 [x] A user can be an administrator
 [x] All users have at least one role
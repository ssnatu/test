## Database tables:

attraction_data:
attr_id - Unique id of each attraction - Primary key
attr_type - Type of attraction [110 - approved, 120 - hidden]
name - Name of the attraction e.g Bull Ring, London Eye
description - Description of the attraction
rating - Rating value of the attraction given by user between 1 to 5
no_of_reviews - number of reviews


users:
user_id - Unique user id - Primary key
user_type - User type [20 - AUTHENTICATED, 30 - ADMIN]
username - User name - Required when reviewing and giving the rating
password - user password
review_status - Indicates whether user has already reviewed the attraction
 0 - can review
 1 - already reviewed, can not review, can only update
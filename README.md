# Blog Api

### This Api for simple blog system

Features 
- Register
- Login
- Post Management   
- Comment Management


-----
# Endpoints 

<span style="color:yellow">**POST**</span> Register New User

```
SERVER_URL/api/register
```
signup to the system

**Body** raw(json)
```
{
    "name": "example",
    "email": "example@email.org",
    "password": "12345678"
}
```
-----

<span style="color:yellow">**POST**</span> Login User

```
SERVER_URL/api/login
```
signin to the system

**Body** raw(json)
```
{
    "email": "example@email.org",
    "password": "12345678"
}
```
-----
<span style="color:yellow">**POST**</span> Logout User

```
SERVER_URL/api/logput
```
signout from the system

**Authorization** Bearer Token

-----

<span style="color:green">**GET**</span> List Posts

```
SERVER_URL/api/posts
```
show all posts

**Authorization** Bearer Token

-----

<span style="color:green">**GET**</span> List User Posts

```
SERVER_URL/api/posts/user/{id}
```
show all posts of specific user

**Authorization** Bearer Token

- id : user id param required (integer) 
-----

<span style="color:green">**GET**</span> List Logged User Posts

```
SERVER_URL/api/posts/own
```
show all posts of logged user

**Authorization** Bearer Token

-----


<span style="color:yellow">**POST**</span> Create Post

```
SERVER_URL/api/posts
```
create new post

**Authorization** Bearer Token

**body** raw(json|form-data)
```
{
    "title": "first post",
    "body": "post created for example",
    "img" : BLOB
}
```

- title : required
- body : required 
- img : required , jpg or png 
 
-----

<span style="color:green">**GET**</span> Show Post

```
SERVER_URL/api/posts/{id}
```
show specific post

**Authorization** Bearer Token

- id : post id param required (integer)
  
-----

<span style="color:blue">**PUT**</span> Edit Post

```
SERVER_URL/api/posts/{id}
```
edit specific post

**Authorization** Bearer Token

- id : post id param required (integer)
  
**body** raw(json|form-data)
```
{
    "title": "edit first post",
    "body": "post edited  for example",
    "img" : BLOB
}
```

- title : required
- body : required 
- img : optional

-----

<span style="color:red">**DELETE**</span> Delete Post

```
SERVER_URL/api/posts/{id}
```
delete specific post

**Authorization** Bearer Token

- id : post id param required (integer)

-----

<span style="color:green">**GET**</span> List user Comments

```
SERVER_URL/api/comments
```
show all comments of authinticated user

**Authorization** Bearer Token

-----

<span style="color:green">**GET**</span> List Post Comments

```
SERVER_URL/api/posts/{id}/comments
```
show all comments of specific post

**Authorization** Bearer Token

- id :  post id param required (integer)

-----

<span style="color:yellow">**POST**</span> Add Comment To Post

```
SERVER_URL/api/posts/{id}/comments
```
Add comments to specific post

**Authorization** Bearer Token

- id :  post id param required (integer)

**body** raw(json)
```
{
    "comment" : "example comment"
}
```
- comment : required

-----

<span style="color:green">**GET**</span> Info Comment

```
SERVER_URL/api/comments/{id}
```
show all info about specific comment

**Authorization** Bearer Token

- id : comment id param required (integer)

-----

<span style="color:blue">**PUT**</span> Edit Comment

```
SERVER_URL/api/comments/{id}
```
update specific comment 

**Authorization** Bearer Token

- id :  comment id param required (integer)

**body** raw(json)
```
{
    "comment" : "example update comment"
}
```
- comment : required

-----

<span style="color:red">**DELETE**</span> Delete Comment

```
SERVER_URL/api/comments/{id}
```
Delete specific comment 

**Authorization** Bearer Token

- id :  comment id param required (integer)

-----

<span style="color:yellow">**POST**</span> Add Replay To Comment

```
SERVER_URL/api/comments/{id}/replay
```
Add Replay To Specific comment

**Authorization** Bearer Token

- id :  comment id param required (integer)

**body** raw(json)
```
{
    "comment" : "example comment"
}
```
- comment : required

-----

<span style="color:green">**GET**</span> Show Comment Replaies

```
SERVER_URL/api/comments/{id}/replay
```
Show All Replaies of Specific comment

**Authorization** Bearer Token

- id :  comment id param required (integer)

-----


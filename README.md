# 6130COMP - Cloud Computing Assignment
This codebase contains my prototype solution for the "Runners Crisps" European Cup competition assignment.

[![European Cup Final](https://images.unsplash.com/photo-1599204606395-ede983387d21?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2340&q=80 "European Cup Final")](https://images.unsplash.com/photo-1599204606395-ede983387d21?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2340&q=80 "European Cup Final")

## Requirements
- Install the docker engine [(link here)](https://docs.docker.com/engine/install/ "(link here)")
- Once installed, install `docker-compose` with the command:
`sudo apt-get install docker-compose`

## Running the solution
On the first run of this project, you will need to build the base image for the backend. This is because it's rather time consuming to set up multiple times, and building this image once means all backend instances run by Docker can simply use this pre-built image to save time.

```
chmod +x build-images.sh
sudo ./build-images.sh
```

Once this command finishes running, simply run:
```sudo docker-compose up``` to start the application

## Project Structure
This web application is split into 3 tiers:
1. Presentation tier: `./frontend`
2. Business tier: `./backend`
3. Database tier: `./database`

## Presentation Tier (frontend)
```
./frontend
	 | nginx
	 | webform
```

`nginx` contains the nginx load balancer for our frontend.
`webform` contains the PHP web form which will be scaled and deployed for our frontend.

Our frontend is a simple HTML form & results page built using PHP templating.
HTML is split into 3 parts:
1.  `upper`:   contains 'upper' portion of the HTML.
2. `view`:    contains the HTML for the form; this portion can be changed to display other views.
3. `lower`:   contains 'lower' portion of the HTML

The 3 parts are then concatenated and displayed.
Templating was done this way (instead of using a templating engine) to reduce the number of dependencies and simplify deployment.

## Business Tier (backend)
```
./backend
	| nginx
	| server
```

`nginx` contains the nginx load balancer for our backend.
`server` contains the PHP server (collection of endpoints) which will be scaled and deployed for our backend.

The business tier handles the processing of the web form data from the presentation tier, communicating with the database to check whether or not the provided voucher code is both valid and / or yields a free football.

## Database Tier
The `./database` folder contains a couple scripts to initialise the MongoDB database.
Our database consists of 3 MongoDB replica set nodes. They elect the `mongo1` instance to be the primary one, with `mongo2` and `mongo3` acting as "failsafes" to provide extra availability. 

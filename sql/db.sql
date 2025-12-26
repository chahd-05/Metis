CREATE DATABASE metis;

use metis;

CREATE TABLE members (
    id INT primary key auto_increment,
    full_name varchar(255),
    email varchar(255),
    Passcode varchar(255)
);

CREATE TABLE projects (
    project_id INT primary key auto_increment,
    project_title varchar(255),
    project_type enum('ShortProject', 'LongProject'),
    id INT,
    foreign key (id) references members (id)
);

CREATE TABLE activity (
    id INT primary key auto_increment,
    acitivity_name varchar(255),
    activity_date datetime default current_timestamp,
    project_id INT,
    foreign key (project_id) references projects (project_id)
);

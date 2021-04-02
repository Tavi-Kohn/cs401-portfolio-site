drop table if exists projects;
drop table if exists users;
drop table if exists passwords;

create table if not exists users (
  id serial primary key,
  username varchar(32) not null
);

create table if not exists passwords (
  user_id int primary key,
  hash varchar(256) not null,
  foreign key (user_id) references users(id)
);

create table if not exists projects (
  id serial primary key,
  user_id int not null,
  name varchar(32) not null,
  description varchar(1024) not null,
  image_uri varchar(64) not null,
  foreign key (user_id) references users(id)
);

insert into users (username) values ('user0');
insert into users (username) values ('user1');

insert into passwords (user_id, hash) values (1, '$2y$10$utCXKqwyWszhjOmsRs6tg.FUKPmAtQrUQYuSO/7V1xj6y3VC8qiL2');
insert into passwords (user_id, hash) values (2, '$2y$10$Rj3AqRdq4rf/oz0tyRVoXuvBy1RFJfRqPYxQmN8iz4gpkpUignk0a');

insert into projects (user_id, name, description, image_uri) values (1, 'user1 project1', 'project 1 description', 'https://source.unsplash.com/random?programming');
insert into projects (user_id, name, description, image_uri) values (1, 'user1 project2', 'project 2 description', 'https://source.unsplash.com/random?tech');
insert into projects (user_id, name, description, image_uri) values (2, 'user2 project1', 'project 1 description', 'https://source.unsplash.com/random?data');

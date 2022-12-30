CREATE TABLE categories
(
    Id SERIAL PRIMARY KEY,
    name CHARACTER VARYING(30),
    alias CHARACTER VARYING(500),
    parent_id INTEGER NULL,
    FOREIGN KEY (parent_id) REFERENCES categories (id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS notes (
   id SERIAL PRIMARY KEY,
   last_modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
   content text
);
--This shows the structure of the table in database.--

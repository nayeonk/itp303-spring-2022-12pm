-- Add album Fight On by artist Spirit of Troy
SELECT * 
FROM albums
ORDER BY album_id DESC;

INSERT INTO albums (title, artist_id)
VALUES ('Fight On', 276 );

SELECT * FROM artists
WHERE name LIKE '%spirit%';

-- Spirit of Troy artist does not exist, need to create a new one.
INSERT INTO artists (name)
VALUES ('Spirit of Troy');


-- Update track All My Love composed by E. Schrody and L. Dimant
-- to be part of 'Fight On' album and composed by Tommy Trojan
UPDATE tracks
SET album_id = 348, composer = 'Tommy Trojan'
-- on option
-- WHERE name = 'All My Love';
WHERE track_id = 3316;

SELECT * 
FROM tracks
WHERE name LIKE 'All My Love';

-- Delete the album 'Fight On'
DELETE
FROM albums
WHERE album_id = 348;
-- The above is giving us an error because we are trying
-- to delete an album that is referenced in another table
-- (the tracks table)

-- Two ways to deal with this
-- 1. Delete the track that references album_id 348
/* DELETE
FROM tracks
WHERE album_id = 348; */

-- 2. Set the tracks that reference album_id 348 to NULL
UPDATE tracks
SET album_id = null
WHERE track_id = 3316;



-- Create a view that displays all albums and their names
-- Only show album id, album title, and artist name

CREATE OR REPLACE VIEW album_artists AS
SELECT album_id, title AS album_title, name AS artist_name
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id;

-- "Call the view"
SELECT * FROM album_artists;

-- Count all the tracks in the database
SELECT COUNT(*)
FROM tracks;

-- Count all the composer in the database
SELECT COUNT(*), COUNT(composer)
FROM tracks;

-- In tracks table, what's the max milliseconds? (aka which track is the longest?)
SELECT MAX(milliseconds), AVG(milliseconds), MIN(milliseconds)
FROM tracks;

-- How long is an album?
SELECT SUM(milliseconds)
FROM tracks
WHERE album_id = 1;

SELECT * FROM tracks;

-- Get the shortest track time for EACH album
SELECT album_id, MIN(milliseconds)
FROM tracks
GROUP BY album_id;

-- For each artist, show artists and number of their albums
SELECT * FROM albums;

SELECT artist_id, COUNT(*)
FROM albums
GROUP BY artist_id;

-- Get the actual artist name
SELECT artists.artist_id, artists.name, COUNT(*)
FROM albums
JOIN artists
	ON albums.artist_id = artists.artist_id
GROUP BY albums.artist_id;
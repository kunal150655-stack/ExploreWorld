-- Run this ONCE in phpMyAdmin for an existing WonderWorld database.
USE wonderworld;

ALTER TABLE destinations
  ADD COLUMN latitude DECIMAL(10,7) DEFAULT NULL,
  ADD COLUMN longitude DECIMAL(10,7) DEFAULT NULL;

UPDATE destinations SET latitude=27.1751, longitude=78.0421 WHERE name='Taj Mahal' AND country='India';
UPDATE destinations SET latitude=26.9124, longitude=75.7873 WHERE name='Jaipur' AND country='India';
UPDATE destinations SET latitude=-8.4095, longitude=115.1889 WHERE name='Bali' AND country='Indonesia';
UPDATE destinations SET latitude=48.8566, longitude=2.3522 WHERE name='Paris' AND country='France';
UPDATE destinations SET latitude=35.0116, longitude=135.7681 WHERE name='Kyoto' AND country='Japan';
UPDATE destinations SET latitude=46.0207, longitude=7.7491 WHERE name='Swiss Alps' AND country='Switzerland';

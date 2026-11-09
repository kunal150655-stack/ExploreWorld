CREATE DATABASE IF NOT EXISTS wonderworld CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wonderworld;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(190) NOT NULL UNIQUE,
 password VARCHAR(255) NOT NULL,
 is_admin TINYINT(1) NOT NULL DEFAULT 0,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE destinations (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(160) NOT NULL,
 country VARCHAR(120) NOT NULL,
 city VARCHAR(120) DEFAULT '',
 description TEXT NOT NULL,
 image_url VARCHAR(600) NOT NULL,
 best_time VARCHAR(160) DEFAULT '',
 travel_tips TEXT,
 latitude DECIMAL(10,7) DEFAULT NULL,
 longitude DECIMAL(10,7) DEFAULT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE favorites (
 id INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NOT NULL,
 destination_id INT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 UNIQUE KEY unique_favorite(user_id,destination_id),
 FOREIGN KEY(user_id) REFERENCES users(id) ON DELETE CASCADE,
 FOREIGN KEY(destination_id) REFERENCES destinations(id) ON DELETE CASCADE
);
CREATE TABLE messages (
 id INT AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(120) NOT NULL,
 email VARCHAR(190) NOT NULL,
 message TEXT NOT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO destinations(name,country,city,description,image_url,best_time,travel_tips,latitude,longitude) VALUES
('Taj Mahal','India','Agra','A breathtaking white-marble monument and UNESCO World Heritage Site, built by Mughal emperor Shah Jahan. Visit at sunrise for beautiful light and a calmer experience.','https://images.unsplash.com/photo-1564507592333-c60657eea523?w=1200','October to March','Carry a valid photo ID, check monument entry rules and arrive early.',27.1751,78.0421),
('Jaipur','India','Rajasthan','Known as the Pink City, Jaipur brings together royal palaces, colourful bazaars, historic forts and vibrant Rajasthani culture.','https://images.unsplash.com/photo-1599661046827-dacff0c0f09a?w=1200','October to March','Wear comfortable shoes for forts and agree on transport prices before travelling.',26.9124,75.7873),
('Bali','Indonesia','Bali','A tropical island known for lush rice terraces, volcanic landscapes, temples, beaches and warm hospitality.','https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=1200','April to October','Respect temple dress codes and local customs; carry a light rain layer.',-8.4095,115.1889),
('Paris','France','Paris','The City of Light is loved for its art, architecture, cafés, gardens and iconic landmarks such as the Eiffel Tower.','https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=1200','April to June, September to October','Book popular attractions ahead and use the Metro to get around.',48.8566,2.3522),
('Kyoto','Japan','Kyoto','Discover traditional wooden streets, peaceful gardens, historic temples and seasonal cherry blossoms in Japan’s former capital.','https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=1200','March to May, October to November','Be considerate in residential lanes and check seasonal temple hours.',35.0116,135.7681),
('Swiss Alps','Switzerland','Zermatt','A spectacular mountain region with scenic railways, alpine villages, hiking trails and dramatic views of the Matterhorn.','https://images.unsplash.com/photo-1531366936337-7c912a4589a7?w=1200','June to September for hiking; December to March for snow','Mountain weather changes quickly; check forecasts and trail conditions.',46.0207,7.7491)
;

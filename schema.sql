CREATE DATABASE IF NOT EXISTS fashion_store;
USE fashion_store;

-- 1. Table: Designer
CREATE TABLE IF NOT EXISTS Designer (
    designer_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    brand_name VARCHAR(100) NOT NULL
);

-- 2. Table: Season_Style
CREATE TABLE IF NOT EXISTS Season_Style (
    style_id INT AUTO_INCREMENT PRIMARY KEY,
    season_name VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL
);

-- 3. Table: Clothing_Item
CREATE TABLE IF NOT EXISTS Clothing_Item (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    designer_id INT,
    style_id INT,
    FOREIGN KEY (designer_id) REFERENCES Designer(designer_id) ON DELETE SET NULL,
    FOREIGN KEY (style_id) REFERENCES Season_Style(style_id) ON DELETE SET NULL
);

-- Insert Sample Data
INSERT INTO Designer (name, brand_name) VALUES 
('Elena Rostova', 'Maison Rostova'),
('Marcus Vance', 'Vance Studio');

INSERT INTO Season_Style (season_name, category) VALUES 
('Spring 2026', 'Luxury Tailoring'),
('Autumn Minimalist', 'Formal Outerwear');

INSERT INTO Clothing_Item (title, price, designer_id, style_id) VALUES 
('Oversized Wool Trench Coat', 285.00, 1, 2),
('Structured Silk Blazer', 210.00, 2, 1);
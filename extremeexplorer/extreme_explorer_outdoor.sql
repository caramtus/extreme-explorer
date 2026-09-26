CREATE DATABASE IF NOT EXISTS extreme_explorer
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE extreme_explorer;

DROP TABLE IF EXISTS products;
DROP TABLE IF EXISTS category;

CREATE TABLE category (
    catID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    catName VARCHAR(30) NOT NULL UNIQUE
) ENGINE=InnoDB;

CREATE TABLE products (
    productID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    productName VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    size VARCHAR(50) DEFAULT NULL,
    colour VARCHAR(50) DEFAULT NULL,
    price DECIMAL(10,2) NOT NULL,
    type VARCHAR(50) DEFAULT NULL,
    image VARCHAR(500) NOT NULL,
    isFeatured TINYINT(1) NOT NULL DEFAULT 0,
    catID INT UNSIGNED NOT NULL,
    CONSTRAINT products_category_fk
        FOREIGN KEY (catID) REFERENCES category(catID)
        ON UPDATE CASCADE
        ON DELETE RESTRICT
) ENGINE=InnoDB;

INSERT INTO category (catID, catName) VALUES
    (1, 'Camping'),
    (2, 'Fishing'),
    (3, 'Boating');

INSERT INTO products
    (productName, description, size, colour, price, type, image, isFeatured, catID)
VALUES
    ('Darche Air-Volution Tent', 'A spacious inflatable touring tent designed for quick setup and comfortable weekends away.', '4 person', 'Eucalypt', 899.00, 'Tent', 'https://images.unsplash.com/photo-1504851149312-7a075b496cc7?auto=format&fit=crop&w=1000&q=85', 1, 1),
    ('Wanderer Camp Chair', 'A supportive folding chair with a durable steel frame, padded seat and convenient cup holder.', 'One size', 'Olive', 89.99, 'Furniture', 'https://images.unsplash.com/photo-1475483768296-6163e08872a1?auto=format&fit=crop&w=1000&q=85', 0, 1),
    ('Yeti Roadie Cooler', 'A compact hard cooler built to keep food and drinks cold through long days outdoors.', '24 L', 'White', 349.95, 'Cooler', 'https://images.unsplash.com/photo-1475483768296-6163e08872a1?auto=format&fit=crop&w=1000&q=85', 1, 1),
    ('Shimano Sedona Combo', 'A balanced spinning rod and reel combination suited to estuary and light coastal fishing.', '7 ft', 'Black', 189.00, 'Rod and Reel', 'https://images.unsplash.com/photo-1541742425281-c1d3fc8aff96?auto=format&fit=crop&w=1000&q=85', 1, 2),
    ('Daiwa Tackle Bag', 'An organised, water-resistant fishing bag with room for tackle trays and everyday essentials.', 'Medium', 'Black', 119.00, 'Storage', 'https://images.unsplash.com/photo-1541742425281-c1d3fc8aff96?auto=format&fit=crop&w=1000&q=85', 0, 2),
    ('Abu Garcia Revo Reel', 'A smooth low-profile baitcaster offering reliable control and dependable casting performance.', 'Right hand', 'Black and red', 249.00, 'Reel', 'https://images.unsplash.com/photo-1541742425281-c1d3fc8aff96?auto=format&fit=crop&w=1000&q=85', 0, 2),
    ('Lowrance Fish Finder', 'A clear colour display with easy-to-use sonar tools for locating fish and underwater structure.', '7 inch', 'Black', 749.00, 'Marine Electronics', 'https://images.unsplash.com/photo-1540946485063-a40da27545f8?auto=format&fit=crop&w=1000&q=85', 1, 3),
    ('Quicksilver Life Jacket', 'A comfortable Australian-standard personal flotation device for safer days on the water.', 'S–XXL', 'Red', 109.95, 'Safety', 'https://images.unsplash.com/photo-1540946485063-a40da27545f8?auto=format&fit=crop&w=1000&q=85', 0, 3),
    ('Engel Marine Fridge', 'A rugged portable fridge-freezer built for boats, campsites and extended road trips.', '40 L', 'Silver', 1299.00, 'Fridge', 'https://images.unsplash.com/photo-1540946485063-a40da27545f8?auto=format&fit=crop&w=1000&q=85', 0, 3);


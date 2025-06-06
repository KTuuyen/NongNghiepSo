CREATE DATABASE QLNNS
GO

USE QLNNS
GO

CREATE TABLE Role (
  id INT PRIMARY KEY IDENTITY(1,1),
  name NVARCHAR(20) NOT NULL
)

CREATE TABLE Users (
  id INT PRIMARY KEY IDENTITY(1,1),
  fullname NVARCHAR(50) NOT NULL,
  email NVARCHAR(150) UNIQUE NOT NULL,
  phone_number NVARCHAR(20),
  address NVARCHAR(200),
  password NVARCHAR(255) NOT NULL, -- Mật khẩu nên được băm
  role_id INT,
  created_at DATETIME DEFAULT GETDATE(),
  updated_at DATETIME DEFAULT GETDATE(),
  deleted BIT DEFAULT 0,
  FOREIGN KEY (role_id) REFERENCES Role(id)
)

CREATE TABLE Tokens (
  user_id INT,
  token NVARCHAR(255),
  created_at DATETIME DEFAULT GETDATE(),
  PRIMARY KEY (user_id, token),
  FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
)

CREATE TABLE Category (
  id INT PRIMARY KEY IDENTITY(1,1),
  name NVARCHAR(100) NOT NULL
)

CREATE TABLE Product (
  id INT PRIMARY KEY IDENTITY(1,1),
  category_id INT,
  title NVARCHAR(250) NOT NULL,
  price INT NOT NULL,
  discount INT DEFAULT 0,
  thumbnail NVARCHAR(500),
  description NVARCHAR(MAX),
  created_at DATETIME DEFAULT GETDATE(),
  updated_at DATETIME DEFAULT GETDATE(),
  deleted BIT DEFAULT 0,
  FOREIGN KEY (category_id) REFERENCES Category(id) ON DELETE CASCADE
)

CREATE TABLE Gallery (
  id INT PRIMARY KEY IDENTITY(1,1),
  product_id INT,
  thumbnail NVARCHAR(500),
  FOREIGN KEY (product_id) REFERENCES Product(id) ON DELETE CASCADE
)

CREATE TABLE FeedBack (
  id INT PRIMARY KEY IDENTITY(1,1),
  firstname NVARCHAR(30),
  lastname NVARCHAR(30),
  email NVARCHAR(250) NOT NULL,
  phone_number NVARCHAR(20),
  subject_name NVARCHAR(350),
  note NVARCHAR(1000),
  status INT DEFAULT 0,
  created_at DATETIME DEFAULT GETDATE(),
  updated_at DATETIME DEFAULT GETDATE()
)

CREATE TABLE Orders (
  id INT PRIMARY KEY IDENTITY(1,1),
  user_id INT,
  fullname NVARCHAR(50) NOT NULL,
  email NVARCHAR(150) NOT NULL,
  phone_number NVARCHAR(20),
  address NVARCHAR(200),
  note NVARCHAR(1000),
  order_date DATETIME DEFAULT GETDATE(),
  status INT DEFAULT 0,
  total_money INT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES Users(id) ON DELETE CASCADE
)

CREATE TABLE Order_Details (
  id INT PRIMARY KEY IDENTITY(1,1),
  order_id INT,
  product_id INT,
  price INT NOT NULL,
  num INT NOT NULL CHECK (num > 0),
  total_money INT NOT NULL,
  FOREIGN KEY (order_id) REFERENCES Orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES Product(id) ON DELETE CASCADE
)

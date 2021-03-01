<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataBaseController extends Controller
{
  public function create()
  {
    $user = 'root';
    $pass = '';
    $dsn = "mysql:host=localhost;dbname=exam;charset=utf8mb4";
    $options = [
      \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
      \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
      \PDO::ATTR_EMULATE_PREPARES => false,
    ];
    try {
      $pdo = new \PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
      throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    try {
      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS users (
      id bigint(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
      name varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      google_id varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      email varchar(255) COLLATE utf8mb4_unicode_ci  UNIQUE KEY NOT NULL,
      email_verified_at timestamp NULL DEFAULT NULL,
      password varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
      remember_token varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
      created_at timestamp NULL DEFAULT NULL,
      updated_at timestamp NULL DEFAULT NULL
    )
  ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci";

      $pdo->exec($sql);
    } catch (PDOException $e) {
      echo $sql . '<br>' . $e->getMessage();
    }


    try {
      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS authors (
 id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 name VARCHAR(64) NOT NULL,
 surname VARCHAR(64) NOT NULL,
 portret VARCHAR(64),
 created_at timestamp NULL DEFAULT NULL,
      updated_at timestamp NULL DEFAULT NULL
 )";
      // use exec() because no results are returned
      $pdo->exec($sql);
      // echo “Table MyGuests created successfully“;
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    try {
      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS books (
 id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
 title VARCHAR(255) NOT NULL,
 isbn VARCHAR(20) NOT NULL,
 pages INT(9) UNSIGNED,
 about TEXT,
 author_id INT(11) UNSIGNED NOT NULL,
 portret VARCHAR(64),
 created_at timestamp NULL DEFAULT NULL,
updated_at timestamp NULL DEFAULT NULL,
 FOREIGN KEY (author_id) REFERENCES authors(id)
 )";
      // use exec() because no results are returned
      $pdo->exec($sql);

      // echo “Table MyGuests created successfully“;
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }


    try {
      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS categories (
id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
title VARCHAR(64),
-- category_id INT(11) UNSIGNED, DEFAULT NULL,
created_at timestamp NULL DEFAULT NULL,
updated_at timestamp NULL DEFAULT NULL
-- FOREIGN KEY (category_id) REFERENCES categories(id)
)";
      // use exec() because no results are returned
      $pdo->exec($sql);
      echo "Table categories created successfully";
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }

    try {
      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS book_categories (
  id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  book_id INT(11) UNSIGNED,
  category_id INT(11) UNSIGNED,
  created_at timestamp NULL DEFAULT NULL,
  updated_at timestamp NULL DEFAULT NULL,
  FOREIGN KEY (book_id) REFERENCES books(id),
  FOREIGN KEY (category_id) REFERENCES categories(id)    
  )";
      // use exec() because no results are returned
      $pdo->exec($sql);
      echo "Table book_categories created successfully";
    } catch (PDOException $e) {
      echo $sql . "<br>" . $e->getMessage();
    }
  }
}

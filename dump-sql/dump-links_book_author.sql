/**
CREATE TABLE IF NOT EXISTS `link_authors_books` (
  `author_id` int(10) unsigned NOT NULL DEFAULT 0,
  `ISBN` varchar(9) NOT NULL DEFAULT '000000000',
  FOREIGN KEY (id_author) REFERENCES authors(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (ISBN) REFERENCES books(ISBN)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

CREATE TABLE IF NOT EXISTS `links_book_author` (
  `book_id` int(9) unsigned NOT NULL  DEFAULT 0,
  `author_id` int(9) unsigned NOT NULL DEFAULT 0,
  FOREIGN KEY (book_id) REFERENCES books(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  FOREIGN KEY (author_id) REFERENCES authors(ID)
    ON DELETE CASCADE
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

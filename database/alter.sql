ALTER TABLE posts ADD CONSTRAINT FK_blog_category FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL;

ALTER TABLE posts ADD CONSTRAINT FK_blog_author FOREIGN KEY (author_id) REFERENCES users(id) ON DELETE CASCADE;
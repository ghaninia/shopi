## 🛍️ Shopi Project

Welcome to the Shopi project! This README.md serves as a comprehensive guide to help you set up and run the Shopi project effortlessly. Follow the steps below to get started:

1. Begin by copying the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```

2. Next, build and run the project using Docker:
   ```markdown
   docker-compose up --build
   ```

3. Install the required composer packages with the following command:
   ```markdown
   make composer-install
   ```

4. Execute the database migrations using the command:
   ```markdown
   make liquibase-migrate
   ```

5. Execute the database migrations using the command:
   ```markdown
   make test
   ```

6. You're all set! Visit `http://localhost/` in your browser to start exploring and using the Shopi Project.

By following these straightforward steps, your 🛍️ Shopi Project will be up and running, ready for you to make orders and manage products.

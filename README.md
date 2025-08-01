# Tagada CRM
### Projet Facturation et gestion clients sous Symfony 7.3.1 et TailwindCSS 4.1

### Installation
1. Clone the repository:
   ```bash
   git clone
    ```
2. Navigate to the project directory:
   ```bash
   cd tagada-crm
   ```
3. Install dependencies:
   ```bash
    composer install
    npm install
    ```
4. Set up the environment file:

5. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
6. Update the `.env` file with your database credentials and other configurations.
7. Generate the application key:
     ```bash
     php bin/console app:generate
       ```
        
8. Create the database:
9. ```bash
   php bin/console doctrine:database:create
   ```
10. Run migrations:
    ```bash
    php bin/console doctrine:migrations:migrate
    ```
11. Load fixtures (optional):
    ```bash
    php bin/console doctrine:fixtures:load
    ```
12. Start the development server:
    ```bash
    symfony server:start
    ```
13. Access the application in your web browser at `http://localhost:8000`.
14. Run the Tailwind CSS build process:
    ```bash
    npm run dev
    ```
### Features
- Client management
- Invoice generation
- Dashboard with statistics
- User authentication
- Responsive design with Tailwind CSS
- Customizable themes
- Multi-language support
- Role-based access control
- API integration for external services
- Email notifications
- PDF generation for invoices
- Data export (CSV, Excel)
- Search functionality
- Advanced filtering options
- Audit logs

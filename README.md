GuardianLink: Secure Cybersecurity Matchmaking 🛡️

GuardianLink is a specialized web platform designed to bridge the gap between non-governmental organizations (NGOs) and cybersecurity specialists. 
In an era of increasing digital threats, this platform facilitates pro-bono security support for vulnerable organizations.

🚀 Technical Stack

    Backend: PHP 8.x
    Database: MySQL 8.0
    Environment: Docker & Docker Compose
    Frontend: Bootstrap 5 (Responsive UI)
    Server: Apache (Debian-based)
    
🔒 Security Features

    Bcrypt Password Hashing: Utilizes PHP password_hash() and password_verify() for industry-standard credential storage.
    Prepared Statements: Full protection against SQL Injection using PDO (PHP Data Objects).
    Session Management: Secure user sessions to handle distinct permissions for Admins, NGOs, and Volunteers.
    Environment Isolation: Containerized architecture ensures the database is not exposed directly to the host machine.

🛠️ Installation & Setup

    To run this project locally, you must have Docker Desktop installed.

    Clone the repository:

      git clone https://github.com/YourUsername/GuardianLink.git
      cd GuardianLink

    Launch the environment:

      docker-compose up -d

    Initialize the Database:
    (Run the following in PowerShell to import the schema:)

      Get-Content schema.sql | docker exec -i guardianlink-db-1 mysql -u guardian_user -psecure_password guardianlink_db

    Access the Application:
      Open your browser to http://localhost:8080

📂 Project Structure

    /src: Contains the core PHP application logic.
    /src/includes: Reusable components (Header/Footer).
    /src/config: Database connection settings.
    docker-compose.yml: Orchestration for the web and database containers.
    schema.sql: Database structure and initial data.

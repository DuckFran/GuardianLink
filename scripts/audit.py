import mysql.connector

try:
    # Connect to the database container
    db = mysql.connector.connect(
        host="localhost", # When running from Windows while Docker is up
        port="3306",
        user="guardian_user",
        password="secure_password",
        database="guardianlink_db"
    )
    cursor = db.cursor()

    print("--- GuardianLink Security Audit ---")
    
    # Task: Find Volunteers without a Background Check
    cursor.execute("SELECT full_name FROM profiles WHERE background_check = 0")
    risky_users = cursor.fetchall()
    
    print(f"\n[!] Flagged Volunteers (No Background Check): {len(risky_users)}")
    for user in risky_users:
        print(f" - {user[0]}")

    db.close()
except Exception as e:
    print(f"Error connecting to DB: {e}")
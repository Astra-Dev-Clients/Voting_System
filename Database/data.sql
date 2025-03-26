-- Create the database
CREATE DATABASE IF NOT EXISTS voting_system;
USE voting_system;

-- Users table for voter registration
CREATE TABLE users (
    SN INT AUTO_INCREMENT PRIMARY KEY,
    First_Name VARCHAR(50) NOT NULL,
    Last_Name VARCHAR(50) NOT NULL,
    Adm_No VARCHAR(20) UNIQUE NOT NULL,
    Email VARCHAR(100) UNIQUE NOT NULL,
    Course VARCHAR(100) NOT NULL,
    Year_of_Study INT NOT NULL,
    Pass VARCHAR(255) NOT NULL,
    user_role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    last_login TIMESTAMP NULL,
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active'
);

-- Positions table for different election positions
CREATE TABLE positions (
    position_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    max_winners INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive') DEFAULT 'active'
);

-- Candidates table for election candidates
CREATE TABLE candidates (
    candidate_id INT AUTO_INCREMENT PRIMARY KEY,
    First_Name VARCHAR(50) NOT NULL,
    Last_Name VARCHAR(50) NOT NULL,
    position_id INT NOT NULL,
    Course VARCHAR(100) NOT NULL,
    Year_of_Study INT NOT NULL,
    Manifesto TEXT,
    Photo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive', 'disqualified') DEFAULT 'active',
);

-- Election settings table to manage election periods
CREATE TABLE election_settings (
    setting_id INT AUTO_INCREMENT PRIMARY KEY,
    election_name VARCHAR(100) NOT NULL,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    status ENUM('pending', 'active', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    created_by INT
    );
    -- Votes table to track voting records
CREATE TABLE votes (
    SN INT AUTO_INCREMENT PRIMARY KEY,
    Course VARCHAR(255) NOT NULL,
    user_adm VARCHAR(50) NOT NULL,
    Cand_adm VARCHAR(50) NOT NULL,
    position VARCHAR(100) NOT NULL,
    voted_on TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- Campaigns table for candidate campaigns
CREATE TABLE campaigns (
    campaign_id INT AUTO_INCREMENT PRIMARY KEY,
    candidate_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    status ENUM('active', 'completed', 'cancelled') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (candidate_id) REFERENCES candidates(candidate_id) ON DELETE CASCADE
);

-- Campaign materials table
CREATE TABLE campaign_materials (
    material_id INT AUTO_INCREMENT PRIMARY KEY,
    campaign_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    description TEXT,
    file_path VARCHAR(255),
    material_type ENUM('image', 'video', 'document') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (campaign_id) REFERENCES campaigns(campaign_id) ON DELETE CASCADE
);

-- Audit log table for tracking system activities
CREATE TABLE audit_log (
    log_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    action VARCHAR(100) NOT NULL,
    details TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(SN)
);

-- Insert default admin user (password: admin123)
INSERT INTO users (First_Name, Last_Name, Adm_No, Email, Course, Year_of_Study, Pass, user_role)
VALUES ('Admin', 'User', 'ADMIN001', 'admin@zetech.ac.ke', 'Administration', 1, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert some default positions
INSERT INTO positions (title, description, max_winners) VALUES
('Student Body President', 'The overall leader of the student body', 1),
('Vice President', 'Assists the president and takes over when president is unavailable', 1),
('Secretary General', 'Handles all administrative duties of the student body', 1),
('Treasurer', 'Manages student body finances', 1),
('Academic Representative', 'Represents students in academic matters', 2),
('Sports Representative', 'Coordinates sports activities', 1),
('Entertainment Representative', 'Organizes entertainment events', 1);

-- Create indexes for better performance
CREATE INDEX idx_user_email ON users(Email);
CREATE INDEX idx_user_adm_no ON users(Adm_No);
CREATE INDEX idx_vote_user ON votes(user_id);
CREATE INDEX idx_vote_position ON votes(position);
CREATE INDEX idx_candidate_position ON candidates(Position);
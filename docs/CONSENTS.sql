-- MEIKING SYSTEMS - Consent Ledger (reusable for multiple forms + cookies)
-- Purpose: store auditable proof of consent (who/what/when/where/version/text)
--
-- Notes:
-- - payload_json is LONGTEXT for compatibility with MariaDB/MySQL variants in XAMPP
-- - subject_type/subject_id allows reusing this table for leads, users, orders, etc.

CREATE TABLE IF NOT EXISTS consents (
  id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

  subject_type VARCHAR(32) NOT NULL,
  subject_id BIGINT UNSIGNED NOT NULL,

  consent_key VARCHAR(64) NOT NULL,
  granted TINYINT(1) NOT NULL,

  consent_version VARCHAR(50) NOT NULL,
  consent_text TEXT NOT NULL,

  ip_address VARCHAR(45) NULL,
  user_agent VARCHAR(255) NULL,
  source_url VARCHAR(2048) NULL,
  referrer_url VARCHAR(2048) NULL,

  payload_json LONGTEXT NULL,

  created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

  INDEX idx_subject (subject_type, subject_id),
  INDEX idx_key (consent_key),
  INDEX idx_created (created_at)
);



# Как установить?
## Добавить эти строки в файл  .env
`GOOGLE_APPLICATION_NAME="Google Sheet"
GOOGLE_CLIENT_ID=357950903114-m9d7p70fqinrtrmm2b1kvo5rvg1c0sli.apps.googleusercontent.com
GOOGLE_CLIENT_SECRET=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
GOOGLE_REDIRECT=http://127.0.0.1:8000/
POST_SPREADSHEET_ID="11kl6nVKs2wi1B8MEiI3mY8P8PZYmHGcVOqJp74laBwk"
POST_SHEET_ID=Sheet1
GOOGLE_DEVELOPER_KEY=AIzaSyDgRraMsvrh0gd9YCQ_nE3wJcXVPrJcQJI
GOOGLE_SERVICE_ENABLED=true
GOOGLE_SERVICE_ACCOUNT_JSON_LOCATION=../storage/credentials.json`

## И сам файл credentials.json который находиться по директиву google-sheet/storage/
`{
  "type": "service_account",
  "project_id": "booming-bonito-378907",
  "private_key_id": "292de7e9235a06ae07a88599068ecc2ce2f8229d",
  "private_key": "-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQDAAUqOou2QPS/F\nUesnVnnHgasEn8r6MujTBCIfsCsW683PuUgKFMDrBUJTav7tDEYj9zJBGpDhLRwh\n21QpyZHnbzCdtC8rBr4BaZfwebvVZCnFw3aOigOM4EKxEpNriupIUXfV1oZdqFSA\nFY5aiqphnOc2pHm40sBsONWcw/StRUyA/vcl97OfHI9/ltW/KpO5G7B616WWg40b\naW9A9Dqru0LfR8f7arkVWOoMKLjdfrNa7DPqTRWVKvwiyIlCPDKnwnhLEIDycx2l\nMXExAd0T9HlnodQvnwo/QkXQw2siE5UqDf1V6qWOuztZxvf/Zcc2y27ooG07VoSN\nhYonQ197AgMBAAECggEAIrJZCcuRiIY2Er9J8lLjMNVS1UQXBv2aKz/M9tL8BmlY\nSNhfl0rGzfGmWbK1HJsiNa+fCjrFwZtIQSoEXITLc/oY2/bKq0jNny24wkENW3N9\nRPqcewefup5wDtWfhEiXK7hlImRg5Z3cn0TF88CpJ3iWI763LFoRYb0nhOu4VHMn\neeHFOatwdCJvHYdOWznfgnl9yGHDpPpP+Mma1bcXSStgIEtDO3Nhdrt6mhWwoF3N\nSzIPIiXS0BMNooCSrxzkxKcZyT2avz/aKqBmgDZP0RDcoG4AD9sBm20LlWfObAhF\nd+lay/ew1yK+QE6Y30dKOe05n7X9XJurOwKWVSlSYQKBgQD/+PVYZ+29oc7a0qGb\nq/+Ie0F+RTlrUYS+vQ/3TMSj9Yb8YoGvJMNuDlNq3WNv8p4WQD1LMgiMbrAEspfW\nDgMo2E3Ie9LOj6t/Zi9/WLdxHuNnILZ8+fJJe6ixrpYp4f+2j8aONo8QykBO3qRP\n3Fi3m9BtCtMk6q0BQ+Tq95gFiwKBgQDABpK6nh5+WnMuyTkEf6IL53lkuqdT00uc\nADLey+qnoa0aa1I5HhpsKZvJYPT/dvDVSN6LP0Lv31gxRWLCTIHB8k3KMgo6orUV\niQfX2VqckFennd4UT5HJo5KCjMHvOHQonMTK2rzQj77rdsWuj0IH/ehnzz2vUyAw\nYAELRbmr0QKBgQC38TilsfGG/xr95rTZgE0dz6ztx2MOusLQql4p0VHRnOPGxCb7\nLEj/8m2Bctw9GzT9OmaRfb/k4rm8dnZkDSe6F042Dr0bUOTlpRHmymLweEjj1/8r\nahXxNlqwbIxeRpiSoVkG4zAF2cFCq/2Zofdi4iZx5YB7m+R870Q2kXv+JwKBgFKa\ngUQGANgZ0LKvnPdycCLu0CmkoZZNrpjM/RUaYzb5NZ3HzPcFHBirTXizXLEIWVFm\np1T/QawuR6HqVzF999OWiCASppPSqlM5P0Z7GZ9/+DUClCXolK5Izx2Zr1NY1Z8i\n0QTyU4bkTxy7Ww5cUeteLjt5yu9AsvgcVFalB9oBAoGBAI5oqMTsnO1A7skwfp0t\n7eiO5d3SqEfZt8TY8ljQ1akZVt7PYIreoJUcYsBdp0oqFSo/0UT2EmLtAH5z2zkc\nlcFcYtaOVTdJoxf/uFVtQtGozB5lk10ZaxpqtzNwwH0ZFUJh9wHO7OJlFvI0QHMD\nwMBqndO3tve/75oYKyUplss0\n-----END PRIVATE KEY-----\n",
  "client_email": "googlesheet@booming-bonito-378907.iam.gserviceaccount.com",
  "client_id": "110399659659253812252",
  "auth_uri": "https://accounts.google.com/o/oauth2/auth",
  "token_uri": "https://oauth2.googleapis.com/token",
  "auth_provider_x509_cert_url": "https://www.googleapis.com/oauth2/v1/certs",
  "client_x509_cert_url": "https://www.googleapis.com/robot/v1/metadata/x509/googlesheet%40booming-bonito-378907.iam.gserviceaccount.com",
  "universe_domain": "googleapis.com"
}`


### Пожалуйста после установки дайте знать чтобы я убрал эти конфиденциальные данные от общего доступа

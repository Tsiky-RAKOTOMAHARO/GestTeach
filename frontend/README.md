# 1. Cloner le projet
git clone git@github.com:Tsiky-RAKOTOMAHARO/GestTeach.git
cd GestTeach

# 2. Configurer la base de données (backend)
cd backend
cp .env.example .env
# Éditer .env avec tes identifiants MySQL (DB_ROOT_PASSWORD, DB_USER, DB_PASSWORD)

# 3. Installer le frontend
cd ../frontend
npm install
npm run dev
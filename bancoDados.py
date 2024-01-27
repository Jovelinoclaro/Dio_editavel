import os
import pymysql
from dotenv import load_dotenv

# Carrega as variáveis de ambiente do arquivo .env
load_dotenv()

# Certifique-se de que as variáveis de ambiente estão definidas corretamente
host = os.environ.get('DB_HOST', 'localhost')
user = os.environ.get('DB_USER', 'root')
password = os.environ.get('DB_PASSWORD', '')

# Solicita o nome do banco de dados
database = input("Digite o nome do banco de dados: ")

# Conecta ao servidor MySQL
mydb = pymysql.connect(
    host=host,
    user=user,
    password=password,
    charset='utf8mb4'
)

# Cria um cursor para executar comandos SQL
mycursor = mydb.cursor()

# Cria o banco de dados
mycursor.execute(f"CREATE DATABASE IF NOT EXISTS {database}")

# Conecta ao banco de dados específico
mydb = pymysql.connect(
    host=host,
    user=user,
    password=password,
    database=database,
    charset='utf8mb4'
)

# Solicita o nome da tabela
table_name = input("Digite o nome da tabela: ")

# Cria uma tabela se não existir
with mydb.cursor() as cursor:
    cursor.execute(
        f'CREATE TABLE IF NOT EXISTS {table_name} ('
        'id INT NOT NULL AUTO_INCREMENT, '
        'dio_fibra varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL, '
        'dio_a varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,'
        'dio_b varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,'
        'dio_c varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,'
        'PRIMARY KEY (id)'
        ') '
    )

# Solicita a quantidade de registros a serem inseridos
num_registros = int(input("Digite a quantidade de registros a serem inseridos: "))

# Adiciona dados à tabela
with mydb.cursor() as cursor:
    for i in range(1, num_registros + 1):
        dio_fibra = str(i)
        dio_a = input("Digite o valor para dio_a: ")
        dio_b = input("Digite o valor para dio_b: ")
        dio_c = input("Digite o valor para dio_c: ")

        insert_query = f"INSERT INTO {table_name} (dio_fibra, dio_a, dio_b, dio_c) VALUES (%s, %s, %s, %s)"
        values = (dio_fibra, dio_a, dio_b, dio_c)
        cursor.execute(insert_query, values)

# Commit das alterações
mydb.commit()
print(f'{num_registros} registros cadastrados com sucesso na tabela {table_name}!')

# Fecha a conexão
mydb.close()

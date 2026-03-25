# ToDoList API

API REST de gerenciamento de tarefas desenvolvida em PHP puro, seguindo os princípios de **Domain-Driven Design (DDD)**, com persistência em MySQL.

---

## Arquitetura

O projeto é organizado em camadas bem definidas dentro de `src/`:

```
src/
├── Domain/          # Regras de negócio (Entidades, Value Objects, Enums, Interfaces)
├── Application/     # Casos de uso (Services, DTOs)
├── Infrastructure/  # Implementações externas (banco de dados, repositórios)
├── Http/            # Controllers, Router, ExceptionHandler
├── public/          # Ponto de entrada da aplicação (index.php)
├── database/        # Scripts SQL
└── composer.json
```

### Camadas

| Camada | Responsabilidade |
|---|---|
| **Domain** | Entidade `Task`, Value Objects (`TaskTitle`, `TaskDescription`), enum `TaskStatus` |
| **Application** | `TaskService` orquestra os casos de uso; `CreateTaskDTO` transporta dados |
| **Infrastructure** | `MySQLTaskRepository` persiste no banco via PDO; `Connection` gerencia o PDO |
| **Http** | `Router` despacha rotas com suporte a path params; controllers tratam requisições |

---

## Endpoints

| Método | Rota | Descrição |
|---|---|---|
| `GET` | `/tasks` | Lista todas as tarefas |
| `POST` | `/tasks` | Cria uma nova tarefa |
| `PUT` | `/tasks/{id}` | Marca uma tarefa como concluída |

### Exemplos de requisição

**Criar tarefa**
```http
POST /tasks
Content-Type: application/json

{
    "title": "Estudar PHP",
    "description": "Revisar conceitos de DDD e arquitetura em camadas"
}
```

**Listar tarefas**
```http
GET /tasks
```

**Concluir tarefa**
```http
PUT /tasks/{id}
```

---

## Requisitos

- Docker e Docker Compose
- MySQL rodando localmente ou via container

---

## Como levantar o ambiente

### 1. Clone o repositório

```bash
git clone <url-do-repositorio>
cd php-estudos
```

### 2. Configure o banco de dados

Edite o arquivo `src/.env` com suas credenciais MySQL:

```env
DB_HOST=localhost
DB_PORT=3306
DB_NAME=todolist
DB_USER=root
DB_PASS=sua_senha
```

### 3. Crie o banco e a tabela

Execute o script SQL no seu MySQL:

```bash
mysql -u root -p < src/database/create_tasks_table.sql
```

### 4. Suba os containers

```bash
docker-compose up -d
```

### 5. Instale as dependências

```bash
docker exec -it php-estudos-php bash -c "cd /var/www/html && composer install"
```

### 6. Acesse a API

A aplicação estará disponível em:

```
http://localhost:8002
```

---

## Regras de validação

| Campo | Mínimo | Máximo |
|---|---|---|
| `title` | 3 caracteres | 120 caracteres |
| `description` | 15 caracteres | 500 caracteres |

---

## Códigos de resposta HTTP

| Código | Situação |
|---|---|
| `200` | Sucesso |
| `400` | Dados inválidos ou tarefa já concluída |
| `404` | Tarefa não encontrada |
| `500` | Erro interno |

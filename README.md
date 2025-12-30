# Sistema de Ramais e Setores

Sistema web para consulta de ramais telefônicos e setores de uma instituição, permitindo busca por nome do setor ou funcionário.

## Funcionalidades

- **Busca por Setor**: Permite localizar o ramal através do nome do setor
- **Busca por Funcionário**: Permite encontrar o ramal através do nome de um funcionário
- **Interface Responsiva**: Design adaptável com estilo profissional
- **Busca Tolerante**: Sistema de normalização de texto para melhor precisão nas consultas

## Estrutura do Sistema

### Arquivos Principais

- `ramais.php` - Interface web e lógica de busca
- `banco_de_dados.sql` - Estrutura do banco de dados MySQL

### Banco de Dados

**Schema**: `mydb`

**Tabela Principal**: `armazenamento`
- `ramal_do_setor` (INT) - Número do ramal telefônico
- `nome_do_setor` (VARCHAR) - Nome do setor/departamento
- `funcionarios_do_setor` (VARCHAR) - Lista de funcionários do setor

## Como Usar

### 1. Configuração do Ambiente

**Pré-requisitos:**
- XAMPP ou servidor web com PHP e MySQL
- MySQL rodando na porta 3306

### 2. Configuração do Banco

```sql
-- Execute o arquivo banco_de_dados.sql para criar a estrutura
mysql -u root -p < banco_de_dados.sql
```

### 3. Configuração da Conexão

O sistema está configurado para:
- **Host**: localhost
- **Usuário**: root
- **Senha**: 123456789
- **Banco**: mydb
- **Porta**: 3306

### 4. Uso da Interface

1. **Busca por Setor**:
   - Digite o nome do setor no campo principal
   - Clique em "Enviar"

2. **Busca por Funcionário**:
   - Marque a opção "Não sei qual setor contatar"
   - Digite o nome do funcionário
   - Clique em "Enviar"

## Características Técnicas

### Segurança
- Consultas preparadas (prepared statements) para prevenir SQL injection
- Sanitização de dados de saída com `htmlspecialchars()`
- Validação de entrada de dados

### Funcionalidades Avançadas
- **Normalização de Texto**: Converte para minúsculas e remove espaços extras
- **Busca Flexível**: Utiliza LIKE com wildcards para busca parcial
- **Interface Dinâmica**: JavaScript para alternar entre tipos de busca
- **Tratamento de Erros**: Mensagens informativas para diferentes cenários

### Design
- Layout centralizado e responsivo
- Esquema de cores profissional (azul marinho/branco)
- Formulários estilizados com CSS
- Feedback visual para interações

## Estrutura do Código

### Funções PHP

- `normalizar($texto)` - Padroniza texto para busca
- `exibirSetor($resultado)` - Formata e exibe resultados da consulta

### Fluxo de Execução

1. Conexão com banco de dados
2. Processamento do formulário POST
3. Normalização dos dados de entrada
4. Execução de consulta preparada
5. Exibição dos resultados formatados

## Exemplo de Uso

**Busca por setor "Pedagogia":**
```
Resultado: Ramal: 1234 | Setor: Curso de Pedagogia | Funcionários: Maria Silva, João Santos
```

**Busca por funcionário "Maria":**
```
Resultado: Ramal: 1234 | Setor: Curso de Pedagogia | Funcionários: Maria Silva, João Santos
```

## Manutenção

Para adicionar novos setores/ramais, insira dados na tabela `armazenamento`:

```sql
INSERT INTO armazenamento (ramal_do_setor, nome_do_setor, funcionarios_do_setor) 
VALUES (1234, 'Nome do Setor', 'Funcionário 1, Funcionário 2');
```

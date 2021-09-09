# λ::nano <sup><small><i>beta</i></small></sup>
![#](https://img.shields.io/badge/λ-nano-e60?style=flat-square)

Pequeno utilitário gerenciador de rotas. **Não é recomendável para ambientes críticos, produção.**

## Primeiros passos

Realize a inclusão do arquivo `./src/bootstrap.php` em seu arquivo php contendo a chamada para a classe `λ` e a seguir configure o Apache, NGINX para que realizem a leitura do diretório `./src`. Não são necessários módulos adicionais e/ou demais configurações.

> Também é possível executar a aplicação utilizando o próprio servidor do PHP conforme exemplo:
> ```
> php -S localhost:8080 -t ./seu_projeto
> ```


## Exemplo de utilização

O exemplo abaixo cria um serviço que retorna as rotas `/` e `/sum`, onde a rota `/sum` pode realizar somas entre N elementos conforme exemplo `/sum/1/2/3/4/5` retorna o JSON com o valor 15.

```php
/**
 * …Instanciando motor com a URL da requisição…
 */
(new class($_SERVER['REQUEST_URI'])

    extends \CORE\λ {})

    /**
     * Rota principal/índice retorna 32 bytes encodados em 64 bits.
     */
    ->route('/', function () {
        return json_encode(["key" => base64_encode(random_bytes(32))]);
    })

    /**
     * Calcula a soma dos parâmetros informados.
     *
     * Ex.: /sum/1/2/3           retorna {"value":6}
     */
    ->route('/sum', function (...$a) {
        return json_encode(["value" => array_sum($a)]);
    });
```
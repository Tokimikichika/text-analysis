# Tokimikichika Text Analysis

Утилита для анализа текста: подсчёт слов, символов, предложений и абзацев.

## Установка

Если используешь как отдельный пакет:
```bash
composer require tokimikichika/text-analysis
```

Если используешь в монорепозитории как path-репозиторий, добавь в composer.json:
```json
{
  "repositories": [
    { "type": "path", "url": "../../text-analysis" }
  ],
  "require": {
    "tokimikichika/text-analysis": "*"
  }
}
```
Затем:
```bash
composer update
```

## Использование

```php
use Tokimikichika\TextAnalysis\TextAnalyzer;
use Tokimikichika\TextAnalysis\ResultFormatter;

$analyzer = new TextAnalyzer();
$text = "Hello world.\n\nAnother paragraph!";

$stats = [
    'words' => $analyzer->countWords($text),
    'characters' => $analyzer->countCharacters($text, true),
    'sentences' => $analyzer->countSentences($text),
    'paragraphs' => $analyzer->countParagraphs($text),
];

$formatter = new ResultFormatter();
$output = $formatter->format($stats);
```

## Возможности

- Подсчёт слов, символов (с опцией исключать пробелы)
- Подсчёт предложений и абзацев
- Простой форматтер результата

## Тестирование

```bash
composer install
composer test
```

## Лицензия

MIT



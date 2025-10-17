<?php

namespace Tokimikichika\TextAnalysis;

/**
 * Класс для анализа текста
 */
class TextAnalyzer
{
    /**
     * Подсчитывает количество слов в тексте
     * 
     * @param string $text Текст для анализа
     * @return int Количество слов
     */
    public function countWords(string $text): int
    {
        $words = preg_split('/[\s\r\n\t]+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        return $words ? count($words) : 0;
    }

    /**
     * Подсчитывает количество символов в тексте
     * 
     * @param string $text Текст для анализа
     * @param bool $excludeSpaces Исключить пробелы
     * @return int Количество символов
     */
    public function countCharacters(string $text, bool $excludeSpaces = false): int
    {
        if ($excludeSpaces) {
            $text = preg_replace('/\s+/u', '', $text);
        }
        return mb_strlen($text ?? '');
    }

    /**
     * Подсчитывает количество предложений в тексте
     * 
     * @param string $text Текст для анализа
     * @return int Количество предложений
     */
    public function countSentences(string $text): int
    {
        $sentences = preg_split('/[.!?]+(?:\s+|$)/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        return $sentences ? count($sentences) : 0;
    }

    /**
     * Подсчитывает количество абзацев в тексте
     * 
     * @param string $text Текст для анализа
     * @return int Количество абзацев
     */
    public function countParagraphs(string $text): int
    {
        $paragraphs = preg_split('/\n{2,}|\r\n{2,}/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        return $paragraphs ? count($paragraphs) : 0;
    }

    /**
     * Вычисляет среднюю длину слова
     * 
     * @param string $text Текст для анализа
     * @return float Средняя длина слова
     */
    public function calculateAverageWordLength(string $text): float
    {
        $words = preg_split('/[\s\r\n\t]+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        if (empty($words)) {
            return 0.0;
        }
        
        $totalLength = 0;
        foreach ($words as $word) {
            $totalLength += mb_strlen($word);
        }
        
        return round($totalLength / count($words), 2);
    }
    
    /**
     * Вычисляет среднюю длину предложения
     * 
     * @param string $text Текст для анализа
     * @return float Средняя длина предложения
     */
    public function calculateAverageSentenceLength(string $text): float
    {
        $sentences = preg_split('/[.!?]+(?:\s+|$)/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        if (empty($sentences)) {
            return 0.0;
        }
        
        $totalWords = 0;
        foreach ($sentences as $sentence) {
            $words = preg_split('/[\s\r\n\t]+/u', trim($sentence), -1, PREG_SPLIT_NO_EMPTY);
            $totalWords += count($words);
        }
        
        return round($totalWords / count($sentences), 2);
    }
    
    /**
     * Получает топ слов
     * 
     * @param string $text Текст для анализа
     * @param int $limit Количество топ слов
     * @return array Топ слов с количеством
     */
    public function getTopWords(string $text, int $limit = 5): array
    {
        $words = preg_split('/[\s\r\n\t]+/u', trim($text), -1, PREG_SPLIT_NO_EMPTY);
        $words = array_map('mb_strtolower', $words);
        $words = array_filter($words, function($word) {
            return mb_strlen($word) > 2; // Исключаем короткие слова
        });
        
        $wordCounts = array_count_values($words);
        arsort($wordCounts);
        
        return array_slice($wordCounts, 0, $limit, true);
    }
    
    /**
     * Форматирует топ слов для frontend
     * 
     * @param array $topWords Ассоциативный массив слов и их количества
     * @return array Массив объектов с полями word и count
     */
    public function formatTopWords(array $topWords): array
    {
        $formatted = [];
        foreach ($topWords as $word => $count) {
            $formatted[] = [
                'word' => $word,
                'count' => $count
            ];
        }
        return $formatted;
    }
}

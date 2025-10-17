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
}

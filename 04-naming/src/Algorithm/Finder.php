<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

final class Finder
{
    /** @var Person[] */
    private $_personList;

    public function __construct(array $personList)
    {
        $this->_personList = $personList;
    }

    public function find(int $ft): PersonaPair
    {
        /** @var PersonaPair[] $tr */
        $tr = [];

        for ($i = 0; $i < count($this->_personList); $i++) {
            for ($j = $i + 1; $j < count($this->_personList); $j++) {
                $r = new PersonaPair();

                if ($this->_personList[$i]->birthDate < $this->_personList[$j]->birthDate) {
                    $r->person1 = $this->_personList[$i];
                    $r->person2 = $this->_personList[$j];
                } else {
                    $r->person1 = $this->_personList[$j];
                    $r->person2 = $this->_personList[$i];
                }

                $r->distanceBetweenBirthDay = $r->person2->birthDate->getTimestamp()
                    - $r->person1->birthDate->getTimestamp();

                $tr[] = $r;
            }
        }

        if (count($tr) < 1) {
            return new PersonaPair();
        }

        $answer = $tr[0];

        foreach ($tr as $result) {
            switch ($ft) {
                case FT::ONE:
                    if ($result->distanceBetweenBirthDay < $answer->distanceBetweenBirthDay) {
                        $answer = $result;
                    }
                    break;

                case FT::TWO:
                    if ($result->distanceBetweenBirthDay > $answer->distanceBetweenBirthDay) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }
}

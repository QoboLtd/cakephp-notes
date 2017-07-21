<?php
if (!$notes->isEmpty()) {
    echo $this->element('Notes.Notes/boxes', ['notes' => $notes, 'shared' => $shared, 'types' => $types]);
}

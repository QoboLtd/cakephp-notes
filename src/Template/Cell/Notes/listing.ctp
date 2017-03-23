<?php
if (!$notes->isEmpty()) {
    echo $this->element('Notes.Notes/boxes', ['notes' => $notes, 'notesView' => 'record']);
}

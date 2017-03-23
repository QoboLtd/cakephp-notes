<?php
if (!$notes->isEmpty()) {
    echo $this->element('Notes.record_notes', ['notes' => $notes, 'notesView' => 'record']);
}

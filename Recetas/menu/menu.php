<?php
if(isset($_GET['seite']))
{
    switch($_GET['seite'])
    {
        case 'tabelle':
            echo '
    <li><a href="?seite=home">Startseite</a></li>
    <li class="active"><a href="?seite=tabelle">Tabelle</a></li>
    <li><a href="?seite=formular">Formular</a></li>
    <li><a href="?seite=course">Course</a></li>';
            break;
        case 'formular':
            echo '<li><a href="?seite=home">Startseite</a></li>
    <li><a href="?seite=tabelle">Tabelle</a></li>
    <li class="active"><a href="?seite=formular">Formular</a></li>
    <li><a href="?seite=course">Course</a></li>';
            break;
        case 'course':
            echo '
    <li><a href="?seite=home">Startseite</a></li>
    <li><a href="?seite=tabelle">Tabelle</a></li>
    <li><a href="?seite=formular">Formular</a></li>
    <li class="active"><a href="?seite=course">Course</a></li>';
            break;
        default:
            echo '
    <li class="active"><a href="?seite=home">Startseite</a></li>
    <li><a href="?seite=tabelle">Tabelle</a></li>
    <li><a href="?seite=formular">Formular</a></li>
    <li><a href="?seite=course">Course</a></li>';
    }
} else
{
    echo '
    <li class="active"><a href="?seite=home">Startseite</a></li>
    <li><a href="?seite=tabelle">Tabelle</a></li>
    <li><a href="?seite=formular">Formular</a></li>
    <li><a href="?seite=course">Course</a></li>';
}
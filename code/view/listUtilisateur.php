<table class="user">
<tr>
    <th scope="col">Utilisateurs</th>
    <th scope="col">Pseudo</th>
    <th scope="col">Rôle</th>
    <th scope="col">Date Inscr.</th>

</tr>

<?php

foreach ($data['utilisateurs'] as $utilisateur) {
    echo '<tr><td>' . $utilisateur->getId() .'</td>
    <td>' . $utilisateur->getPseudo() .'</td>
    <td>' . $utilisateur->getRole() .'</td>
    <td>' . $utilisateur->getDateinscription() .'</td></tr>';
}

?>

</table>

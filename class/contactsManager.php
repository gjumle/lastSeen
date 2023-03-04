<?php 

class ContactsManager {
    public static function getContacts($cid = null) {
        $pdo = DB::connectPDO();
        $condition = ($cid == null) ? "" : " WHERE cid = ?";
        $sql = "SELECT * FROM contacts $condition";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cid]);
        $contacts = [];
        while ($row = $stmt->fetch()) {
            $contacts[] = new Contact($row['cid'], $row['user_id'], $row['f_name'], $row['l_name'], $row['email'], $row['last_seen'], $row['count_seen'], $row['duration_seen']);
        }
        return $contacts;
    }

    public static function getContact($cid) {
        $contacts = self::getContacts($cid);
        return $contacts[0];
    }

    public static function renderContacts() {
        $html = "<button><a href='?add'>Add contact</a></button>";
        if (isset($_GET['add'])) {
            $html .= "<div class='container'>
                <div class='contacts'>
                    <h1>Add contact</h1>
                </div>
            </div>
            <div class='container'>
                <div class='contact'>
                    <form action='contacts.php' method='POST'>
                        <div class='contact-info'>
                            <input type='text' name='f_name' placeholder='First name'>
                            <input type='text' name='l_name' placeholder='Last name'>
                            <input type='email' name='email' placeholder='Email'>
                        </div>
                        <div class='contact-stats'>
                            <input type='submit' name='add' value='Add'>
                        </div>
                    </form>
                </div>
            </div>";
        } elseif (isset($_GET['edit'])) {
            $contact = self::getContact($_GET['edit']);
            $html .= "<div class='container'>
                <div class='contacts'>
                    <h1>Edit contact</h1>
                </div>
            </div>
            <div class='container'>
                <div class='contact'>
                    <form action='contacts.php' method='POST'>
                        <div class='contact-info'>
                            <input type='text' name='f_name' value='$contact->f_name' placeholder='First name'>
                            <input type='text' name='l_name' value='$contact->l_name' placeholder='Last name'>
                            <input type='email' name='email' value='$contact->email' placeholder='Email'>
                        </div>
                        <div class='contact-stats'>
                            <input type='submit' name='edit' value='Save'>
                        </div>
                    </form>
                </div>
            </div>";
        } else {
            $html .= "<div class='container'>
                <div class='contacts'>
                    <h1>Contacts</h1>
                </div>
            </div>";

            $contacts = self::getContacts();
            foreach ($contacts as $contact) {
                $html .= "<div class='container'>
                    <div class='contact'>
                        <div class='contact-info'>
                            <h2>$contact->f_name $contact->l_name</h2>
                            <p>$contact->email</p>
                        </div>
                        <div class='contact-stats'>
                            <p>Last seen: $contact->last_seen</p>
                            <p>Count seen: $contact->count_seen</p>
                            <p>Duration seen: $contact->duration_seen</p>
                        </div>
                    </div>
                </div>";
            }
        }
        return $html;
    }
}
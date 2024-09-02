<style>
    .user_info {
        border-collapse: collapse;
        width: 100%;
        margin-top: 20px;
        font-size: 16px;
    }

    .user_info tr {
        padding: 20px;
    }
</style>
<x-mail::message>
    <b>Merhaba Sayın Yönetici,</b>
    <br><br>
    Web sitenizde bulunan iletişim formu aracılığı ile bir ziyaretçiniz tarafından mesaj gönderildi.
    <hr>
    Konu : {{ $subject }}
    <hr>
    <table class="user_info">
        <tr>
            <td>Adı Soyadı</td>
            <td>:</td>
            <td>{{ $name }}</td>
        </tr>
        <tr>
            <td>E-Mail</td>
            <td>:</td>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <td>Telefon</td>
            <td>:</td>
            <td>{{ $phone }}</td>
        </tr>
        <tr>
            <td>Mesaj</td>
            <td>:</td>
            <td>{{ $message }}</td>
        </tr>
    </table>
</x-mail::message>

<?php
session_start();
if (empty($_SESSION['login']) or empty($_SESSION['password'])) 
{
//���� �� ���������� ������ � ������� � �������, ������ �� ���� ���� ����� ���������� ������������. ��� ��� �� �����. ������ ��������� �� ������, ������������� ������
exit ("������ �� ��� �������� �������� ������ ������������������ �������������. ���� �� ����������������, �� ������� �� ���� ��� ����� ������� � �������<br><a href='../index.php'>������� ��������</a>");
}

unset($_SESSION['password']);
unset($_SESSION['login']); 
unset($_SESSION['id']);
unset($_SESSION['rights']);// ���������� ���������� � �������

exit("<html><head><meta http-equiv='Refresh' content='0; URL=../index.php'></head></html>");

// ���������� ������������ �� ������� ��������.
?>
<?php
const salt = "asjdokJSOFJASfmmaokfMasJFkanfanfL";
function passwordHash ($passwordString)
{
    return sha1(salt.$passwordString.salt);
}
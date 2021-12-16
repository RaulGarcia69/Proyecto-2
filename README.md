# proyecto-2


SELECT tbl_mesa.id_mes FROM tbl_mesa inner JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk where tbl_mesa.id_mes=2 and tbl_reserva.horaFin_res is null and tbl_reserva.horaIni_res BETWEEN "2021-12-10 16:00:00" and "2021-12-10 16:30:00";

$date = date('Y-m-d H:i:s');

echo date('Y-m-d', strtotime($date. ' + 10 days'));


esto
SELECT tbl_mesa.id_mes from tbl_mesa INNER JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk where (tbl_reserva.horaIni_res BETWEEN "2021-12-12 18:00:00" and "2021-12-12 18:30:00") or (tbl_reserva.horaFin_res BETWEEN "2021-12-12 18:00:00" and "2021-12-12 18:30:00");


SELECT ((SELECT COUNT(*) FROM tbl_mesa WHERE id_sal_fk=1)- (SELECT COUNT(*) from tbl_mesa INNER JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk where (tbl_reserva.horaIni_res = "2021-12-13 20:00:00" and tbl_mesa.id_sal_fk=1) or (tbl_reserva.horaFin_res > "2021-12-13 20:00:00" and tbl_mesa.id_sal_fk=1)));


ver mesa si reservada
SELECT * from tbl_mesa INNER JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk where (tbl_reserva.horaIni_res = "2021-12-15 18:00:00" and tbl_mesa.id_sal_fk=5 and tbl_mesa.id_mes=44) or (tbl_reserva.horaFin_res > "2021-12-15 18:00:00" and tbl_mesa.id_sal_fk=5 and tbl_reserva.horaIni_res < "2021-12-15 18:00:00" and tbl_mesa.id_mes=44);



acabar o cancelar reserva
SELECT * from tbl_mesa INNER JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk WHERE tbl_reserva.horaIni_res>"2021-12-16 15:30:00"
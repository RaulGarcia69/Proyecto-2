# proyecto-2


SELECT tbl_mesa.id_mes FROM tbl_mesa inner JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk where tbl_mesa.id_mes=2 and tbl_reserva.horaFin_res is null and tbl_reserva.horaIni_res BETWEEN "2021-12-10 16:00:00" and "2021-12-10 16:30:00";

$date = date('Y-m-d H:i:s');

echo date('Y-m-d', strtotime($date. ' + 10 days'));


esto
SELECT tbl_mesa.id_mes from tbl_mesa INNER JOIN tbl_reserva on tbl_mesa.id_mes=tbl_reserva.id_mes_fk where (tbl_reserva.horaIni_res BETWEEN "2021-12-12 18:00:00" and "2021-12-12 18:30:00") or (tbl_reserva.horaFin_res BETWEEN "2021-12-12 18:00:00" and "2021-12-12 18:30:00");
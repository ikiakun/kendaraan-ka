create table perawatans

`kendaraan_spesifikasi_id` bigint(20) UNSIGNED NOT NULL,

alter table perawatans

ADD CONSTRAINT `perawatans_kendaraan_spesifikasi_id_foreign` FOREIGN KEY (`kendaraan_spesifikasi_id`) REFERENCES `kendaraan_spesifikasis` (`id`),

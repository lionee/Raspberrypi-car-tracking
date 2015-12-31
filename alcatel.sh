#!/bin/bash
#
#
 
for i in /sys/bus/usb/devices/*; do
	if [[ `grep -s 1bbb ${i}/idVendor` ]] && [[ `grep -s 022c ${i}/idProduct` ]]; then
		DEVICE=$i
		break
	fi
done
 
if [[ -z ${DEVICE} ]]; then
	echo "Device not found"
	exit 1
fi
 
if [[ `cat ${i}/bNumConfigurations` == 2 ]]; then
	if [[ `cat ${i}/bConfigurationValue` == 1 ]]; then
		sudo sh -c "echo 2 > ${i}/bConfigurationValue"
		sudo modprobe option
		sudo sh -c "echo 1bbb 022c ff > /sys/bus/usb-serial/drivers/option1/new_id"
	fi
fi

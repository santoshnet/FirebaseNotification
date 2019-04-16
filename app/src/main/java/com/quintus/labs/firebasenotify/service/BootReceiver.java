package com.quintus.labs.firebasenotify.service;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;

public class BootReceiver extends BroadcastReceiver {

    @Override
    public void onReceive(Context context, Intent intent) {
        if (intent.getAction().equals("android.intent.action.BOOT_COMPLETED")) {

            Intent startServiceIntent = new Intent(context, MyFirebaseInstanceIDService.class);
            context.startService(startServiceIntent);

            Intent notificationServiceIntent = new Intent(context, MyFirebaseMessagingService.class);
            context.startService(notificationServiceIntent);
        }
    }
}
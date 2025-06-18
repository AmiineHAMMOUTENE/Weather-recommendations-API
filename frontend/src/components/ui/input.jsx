// src/components/ui/input.jsx
import * as React from "react";

export const Input = React.forwardRef(({ className = "", ...props }, ref) => {
  return (
    <input
      ref={ref}
      className={
        "w-full rounded-md border border-gray-300 px-3 py-2 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 " + className
      }
      {...props}
    />
  );
});

Input.displayName = "Input";
